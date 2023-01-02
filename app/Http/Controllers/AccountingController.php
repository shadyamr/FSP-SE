<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use App\Models\User;
use App\Models\RequestsForm;
use App\Models\RequestsInspections;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->back();
    }

    public function salaries()
    {
        $employees_all = User::with('roles')->get();
        return view('accounting.salaries', compact('employees_all'));
    }

    public function edit_salaries_preview($id)
    {
        $edit_user_salary = User::find($id);
        return view('accounting.editsalaries', compact('edit_user_salary'));
    }

    public function edit_salary($id, Request $request)
    {
        $employee = User::find($id);

        $employee->salary = $request->input('salary');

        $employee->save();

        $log = new LogsController();
        if ($request->input('salary') > $request->input('o_salary')) {
            $log->store('edit_salary:increase', $id);
        } else if ($request->input('salary') < $request->input('o_salary')) {
            $log->store('edit_salary:decrease', $id);
        } else {
            $log->store('edit_salary', $id);
        }

        return redirect()->back()->with('success', 'Salary edited successfully.');
    }

    public function invoice()
    {
        $all_requests = RequestsForm::all();
        //return $employees_all;
        return view('accounting.invoices', compact('all_requests'));
    }

    public function invoice_pdf()
    {
        $client = new Party([
            'name'          => 'FSPMS Company Co.',
            'phone'         => '01009019222',
            'custom_fields' => [
                'address'        => 'KM 28; Cairo Ismailia Road Ahmed Orabi District',
                'city & Country'   => 'CAI, Egypt',
            ],
        ]);

        $customer = new Party([
            'name'          => 'Ashley Medina',
            'address'       => 'The Green Street 12',
            'code'          => '#22663214',
            'custom_fields' => [
                'order number' => '> 654321 <',
            ],
        ]);

        $items = [
            /*(new InvoiceItem())
                ->title('Service 1')
                ->description('Your product or service description')
                ->pricePerUnit(47.79)
                ->quantity(2)
                ->discount(10),*/
            //(new InvoiceItem())->title('Service 2')->pricePerUnit(71.96)->quantity(2),
            (new InvoiceItem())->title('Service 3')->pricePerUnit(4.56),
        ];

        $notes = [
            'Generated by the FSPMS website',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('Invoice')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('m/d/Y')
            ->taxRate(14)
            ->currencySymbol('£EGP ')
            ->currencyCode('EGP')
            ->currencyFraction('piastres (ersh)')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint('.')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('img/logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}