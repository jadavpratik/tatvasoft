<div class="customer_current_service_requests">
    <p>Current Service Requests</p>
    <button class="add_new_service_request_btn">Add New Service Request</button>
</div>
<table>
    <thead>
        <tr>
            <th>Service Id</th>
            <th>Service Date</th>
            <th>Service Provider</th>
            <th>Payment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><p class="service_id">8485</p></td>
            <td>
                <div class="service_date">
                    <div>
                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                        <p>05/10/2021</p>
                    </div>
                    <div>
                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                        <p><span>08:00</span> - <span>11:30</span></p>
                    </div>
                </div>
            </td>
            <td>
                <div class="service_provider"></div>
            </td>
            <td>
                <p class="payment_text"><span>87,50</span>€</p>
            </td>
            <td>
                <div class="table_btn_container">
                    <button class="reschedule_btn">Reschedule</button>
                    <button class="cancel_btn">Cancel</button>    
                </div>
            </td>
        </tr>
        <tr>
            <td><p class="service_id">8479</p></td>
            <td>
                <div class="service_date">
                    <div>
                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                        <p>05/10/2021</p>
                    </div>
                    <div>
                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                        <p><span>08:00</span> - <span>11:30</span></p>
                    </div>
                </div>
            </td>
            <td>
                <div class="service_provider">
                    <img class="hat_style" src="<?= assets('assets/img/table/hat.png'); ?>" alt="">
                    <div>
                        <p>Lyum Watson</p>    
                        <div>
                            <i class="fas fa-star rated_star"></i>
                            <i class="fas fa-star rated_star"></i>
                            <i class="fas fa-star rated_star"></i>
                            <i class="fas fa-star rated_star"></i>
                            <i class="fas fa-star unrated_star"></i>
                            <span>4</span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <p class="payment_text"><span>75,00</span>€</p>
            </td>
            <td>
                <div class="table_btn_container">
                    <button class="reschedule_btn">Reschedule</button>
                    <button class="cancel_btn">Cancel</button>    
                </div>
            </td>
        </tr>
    </tbody>
</table>