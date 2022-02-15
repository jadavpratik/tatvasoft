<div class="make_payment">
    <div>
        <p>Pay Securely with Helperland payment gateway!</p>
        <div>
            <div class="label_input">
                <label class="label" for="">Promo Code (Optional)</label>
                <input class="input" type="text">
            </div>
            <button class="book_service_outline_btn">Apply</button>	
        </div>
    </div>
    <div class="label_input">
        <div>
            <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" id="card_no" maxlength="19">
            <input type="text" placeholder="MM/YY">	
            <input type="text" placeholder="CVV/CVC">
        </div>
        <div>
            <p>Accepeted Card</p>
            <div>
                <img title="Visa Card" src="<?= assets('assets/img/customer/book_service/visa.png'); ?>" alt="">
                <img title="Master Card" src="<?= assets('assets/img/customer/book_service/master_card.png'); ?>" alt="">
                <img title="American Express" src="<?= assets('assets/img/customer/book_service/american_express.png'); ?>" alt="">
            </div>
        </div>
    </div>
    <div>
        <input type="checkbox">
        <label for="">I accept the <a href="#">term and condition</a>. the <a href="#">cancellation policy</a> and the <a href="#">privacy policy</a>. i confirm that helperland start to execute that contract before the expiry of the withdrawal period and i lose my right of withdrawal as consumer with full performance of the contract.</label>
    </div>
    <button id="confirm_booking_submit_btn" class="book_service_btn">Complete Booking</button>
</div>
