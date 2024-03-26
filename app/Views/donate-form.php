<form action="<?=env('app.baseURL')?>paydonation" method="post" class="container mt-4">

        <!-- Name field -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <!-- Email field -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <!-- Mobile field -->
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" class="form-control" required>
        </div>

        <!-- Radio buttons for values 1100, 2200, 5500, Other -->
        <label for="Amount">Amount:</label>
        <div class="form-group">
            <div class="btn-group py-1">
                <button type="button" class="btn btn-secondary" onclick="addAmountToInput(1100)">1100</button>
                <button type="button" class="btn btn-secondary" onclick="addAmountToInput(2200)">2200</button>
                <button type="button" class="btn btn-secondary" onclick="addAmountToInput(5500)">5500</button>
            </div>
            <input type="number" id="amount" inputmode="numeric" name="amount" min="1000" max="500000" class="form-control py-1" required>
        </div>

        <!-- Radio button for Indian or Foreign citizen -->
        
        <label for="nationality">Nationality:</label>
        <div class="form-group d-flex">
            <div class="form-check mr-2">
                <input type="radio" id="indian" name="citizen" value="indian" class="form-check-input" required>
                <label for="indian" class="form-check-label">Indian</label>
            </div>
            <div class="form-check mx-2">
                <input type="radio" id="foreign" name="citizen" value="foreign" class="form-check-input" required>
                <label for="foreign" class="form-check-label">Foreign</label>
            </div>
        </div>


        <!-- Checkbox for Keep me anonymous -->
        <label for="anon">Remain Anonymous:</label>
        <div class="form-check">
            <input type="checkbox" id="anonymous" name="anonymous" value="1" class="form-check-input">
            <label for="anonymous" class="form-check-label">Keep me Anonymous</label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mt-3">Pay Donation <span id="amountShow"></span></button>

    </form>
   
    <script>
 function addAmountToInput(amount){
           
            let input = document.querySelector('#amount');
            let amountShow = document.querySelector('#amountShow');
            amountShow.textContent =``;
            input.value = amount;
            amountShow.textContent = `of ₹${amount}`;
        }
let input = document.querySelector('#amount');

input.addEventListener('input',()=>{
    let amountshow = document.querySelector('#amountShow');
    amountShow.textContent =``;
    
    amountShow.textContent = `of ₹${input.value}`;
})
</script>