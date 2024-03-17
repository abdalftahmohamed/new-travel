<script src="{{URL::asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>


{{--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>--}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the necessary elements for both ticket types
        var quantityOldInput = document.getElementById("quantity_old");
        var oldSubtotalInput = document.getElementById("old_subtotal");
        var oldPrice = {{$trip->old_price}};

        var quantityYoungInput = document.getElementById("quantity_young");
        var youngSubtotalInput = document.getElementById("young_subtotal");
        var youngPrice = {{$trip->young_price}};

        var finalSubtotalInput = document.getElementById("final_subtotal");
        var finalTotalInput = document.getElementById("final_total");

        var form = document.querySelector('form');

        // Update subtotals on page load
        updateOldSubtotal();
        updateYoungSubtotal();


        // Event listener for decrease button
        document.querySelector(".decrease-old").addEventListener("click", function () {
            if (quantityOldInput.value > 1) {
                quantityOldInput.value = parseInt(quantityOldInput.value)-1;
            }
            updateOldSubtotal();
            updateFinalSubtotal();
        });

        // Event listener for increase button
        document.querySelector(".increase-old").addEventListener("click", function () {
            // console.log("jjjjj");
            quantityOldInput.value = parseInt(quantityOldInput.value)+1;
            updateOldSubtotal();
            updateFinalSubtotal();
        });



        // Event listener for manual input change (adult)
        quantityOldInput.addEventListener("input", function () {
            updateOldSubtotal();
            updateFinalSubtotal();
        });

        // Event listener for decrease button (young)
        document.querySelector(".decrease-young").addEventListener("click", function () {
            if (quantityYoungInput.value > 0) {
                quantityYoungInput.value--;
            }
            updateYoungSubtotal();
            updateFinalSubtotal();
        });

        // Event listener for increase button (young)
        document.querySelector(".increase-young").addEventListener("click", function () {
            quantityYoungInput.value++;
            updateYoungSubtotal();
            updateFinalSubtotal();
        });

        // Event listener for manual input change (young)
        quantityYoungInput.addEventListener("input", function () {
            updateYoungSubtotal();
            updateFinalSubtotal();
        });

        // Event listener for form submission
        form.addEventListener('submit', function () {
            var subtotal = $('[name="final_subtotal"]').val();
            $('<input>').attr({
                type: 'hidden',
                name: 'subtotal',
                value: subtotal,
            }).appendTo($(this));

            // Set the value of old_subtotal and young_subtotal before form submission
            form.elements['old_subtotal'].value = oldSubtotalInput.value;
            form.elements['young_subtotal'].value = youngSubtotalInput.value;
            form.elements['final_subtotal'].value = finalSubtotalInput.value;
            form.elements['final_total'].value = finalTotalInput.value;

        });

        // Function to update old_subtotal based on quantity (adult)
        function updateOldSubtotal() {
            var quantityOld = parseInt(quantityOldInput.value);
            var subtotalOld = quantityOld * oldPrice;
            oldSubtotalInput.value = subtotalOld.toFixed(0);

        }

        // Function to update young_subtotal based on quantity (young)
        function updateYoungSubtotal() {
            var quantityYoung = parseInt(quantityYoungInput.value);
            var subtotalYoung = quantityYoung * youngPrice;
            youngSubtotalInput.value = subtotalYoung.toFixed(0);
        }
        function updateFinalSubtotal() {
            var subtotalOld = parseFloat(oldSubtotalInput.value.replace("$", ""));
            var subtotalYoung = parseFloat(youngSubtotalInput.value.replace("$", ""));
            var finalSubtotal = subtotalOld + subtotalYoung;
            var finalTotal = subtotalOld + subtotalYoung;
            finalSubtotalInput.value = finalSubtotal.toFixed(0);
            finalTotalInput.value = finalTotal.toFixed(0);
        }
    });
</script>










<script>
    document.getElementById("check_coupon").addEventListener("click", function () {
        var couponCode = document.getElementById("coupon").value;
        checkCoupon(couponCode);
    });

    function checkCoupon(couponCode) {
        // Assuming you have a server-side endpoint named 'newCheckCoupon'
        var url = "/newCheckCoupon?code=" + couponCode;

        // Make an AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                handleCouponResponse(xhr.responseText);
            }
        };

        var data = JSON.stringify({ coupon: couponCode });
        xhr.send(data);
    }

    function handleCouponResponse(response) {
        var statusContainer = document.getElementById("coupon-status");
        var discountInput = document.getElementById("discount");
        var finalSubtotalInput = document.getElementById("final_subtotal");
        var finalTotalInput = document.getElementById("final_total");

        try {
            var responseData = JSON.parse(response);

            if (responseData.status === "success") {
                // Coupon is valid, calculate discount and update the input fields
                var couponAmount = responseData.coupon_data.coupon_amount;
                var finalSubtotal = parseFloat(finalSubtotalInput.value.replace("$", ""));
                var discount = (couponAmount * finalSubtotal) / 100;

                // Update the discount input field
                discountInput.value = discount.toFixed(0);

                // Calculate and update the final_total input field
                var finalTotal = finalSubtotal - discount;
                finalTotalInput.value = finalTotal.toFixed(0);

                // Display a success message or any other relevant information
                statusContainer.innerHTML = responseData.message;
            } else {
                // Display an error message or any other relevant information
                statusContainer.innerHTML = responseData.message;
            }
        } catch (error) {
            console.error("Error parsing JSON response: ", error);
            statusContainer.innerHTML = "Error processing coupon data.";
        }
    }
</script>









{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function () {--}}
{{--        var quantityOldInput = document.getElementById("quantity_old");--}}
{{--        var oldSubtotalInput = document.getElementById("old_subtotal");--}}
{{--        var oldPrice = {{$trip->old_price}};--}}

{{--        var quantityYoungInput = document.getElementById("quantity_young");--}}
{{--        var youngSubtotalInput = document.getElementById("young_subtotal");--}}
{{--        var youngPrice = {{$trip->young_price}};--}}

{{--        var finalSubtotalInput = document.getElementById("final_subtotal");--}}
{{--        var finalTotalInput = document.getElementById("final_total");--}}
{{--        var checkCouponButton = document.getElementById("check_coupon");--}}

{{--        // Update subtotals on page load--}}
{{--        updateOldSubtotal();--}}
{{--        updateYoungSubtotal();--}}
{{--        updateFinalSubtotal();--}}

{{--        // Event listener for increase button (old)--}}
{{--        document.querySelector(".increase-old").addEventListener("click", function () {--}}
{{--            quantityOldInput.value++;--}}
{{--            updateOldSubtotal();--}}
{{--            updateFinalSubtotal();--}}
{{--        });--}}

{{--        // Event listener for manual input change (old)--}}
{{--        quantityOldInput.addEventListener("input", function () {--}}
{{--            updateOldSubtotal();--}}
{{--            updateFinalSubtotal();--}}
{{--        });--}}

{{--        // Event listener for increase button (young)--}}
{{--        document.querySelector(".increase-young").addEventListener("click", function () {--}}
{{--            quantityYoungInput.value++;--}}
{{--            updateYoungSubtotal();--}}
{{--            updateFinalSubtotal();--}}
{{--        });--}}

{{--        // Event listener for manual input change (young)--}}
{{--        quantityYoungInput.addEventListener("input", function () {--}}
{{--            updateYoungSubtotal();--}}
{{--            updateFinalSubtotal();--}}
{{--        });--}}

{{--        // Event listener for coupon check--}}
{{--        checkCouponButton.addEventListener("click", function () {--}}
{{--            var couponCode = document.getElementById("coupon").value;--}}
{{--            checkCoupon(couponCode);--}}
{{--        });--}}

{{--        function updateOldSubtotal() {--}}
{{--            var quantityOld = parseInt(quantityOldInput.value);--}}
{{--            var subtotalOld = quantityOld * oldPrice;--}}
{{--            oldSubtotalInput.value =  subtotalOld.toFixed(0);--}}
{{--        }--}}

{{--        function updateYoungSubtotal() {--}}
{{--            var quantityYoung = parseInt(quantityYoungInput.value);--}}
{{--            var subtotalYoung = quantityYoung * youngPrice;--}}
{{--            youngSubtotalInput.value =  subtotalYoung.toFixed(0);--}}
{{--        }--}}

{{--        function updateFinalSubtotal() {--}}
{{--            var subtotalOld = parseFloat(oldSubtotalInput.value.replace("$", ""));--}}
{{--            var subtotalYoung = parseFloat(youngSubtotalInput.value.replace("$", ""));--}}
{{--            var finalSubtotal = subtotalOld + subtotalYoung;--}}
{{--            finalSubtotalInput.value =  finalSubtotal.toFixed(0);--}}

{{--            // Calculate discount and update final total--}}
{{--            var discount = parseFloat(document.getElementById("discount").value.replace("$", ""));--}}
{{--            var finalTotal = finalSubtotal - discount;--}}
{{--            finalTotalInput.value =  finalTotal.toFixed(0);--}}
{{--        }--}}

{{--        function checkCoupon(couponCode) {--}}
{{--  --}}
{{--        }--}}

{{--    });--}}
{{--</script>--}}




