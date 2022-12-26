<form method="POST" action="{{ route('requests.store') }}">
    @csrf
    <div>
        <label for="corporate_name">Corporate Name:</label>
        <input type="text" name="corporate_name" id="corporate_name">
    </div>
    <div>
        <label for="corporate_address">Corporate Address:</label>
        <input type="text" name="corporate_address" id="corporate_address">
    </div>
    <div>
        <label for="corporate_budget">Corporate Budget:</label>
        <input type="number" name="corporate_budget" id="corporate_budget">
    </div>
    <div>
        <label for="client_extra">Additional Information:</label>
        <textarea name="client_extra" id="client_extra"></textarea>
    </div>
    <button type="submit" onclick="addClient()">Add Client</button>
</form>

<script>
    function addClient() {
        var corporateName = document.getElementById('corporate_name').value;
        var corporateAddress = document.getElementById('corporate_address').value;
        var corporateBudget = document.getElementById('corporate_budget').value;
        var clientExtra = document.getElementById('client_extra').value;

        axios.post('/requests', {
            corporate_name: corporateName,
            corporate_address: corporateAddress,
            corporate_budget: corporateBudget,
            client_extra: clientExtra
        })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
    }
</script>