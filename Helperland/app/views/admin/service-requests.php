<div class="service_requests">
    <div>
        <p>Service Requests</p>
    </div>
    <div>
        <input class="input" type="text" placeholder="Service ID">
        <select class="select" name="" id="">
            <option value="">Customer</option>
        </select>
        <select class="select" name="" id="">
            <option value="">Service Provider</option>
        </select>
        <select class="select" name="" id="">
            <option value="">Status</option>
        </select>
        <div class="from_date">
            <label for="from_date">
                <img src="<?= assets('assets/img/table/calendar_blue.png'); ?>" alt="">
            </label>
            <input type="date" id="from_date">
            <span>From</span>
        </div>
        <div class="to_date">
            <label for="to_date">
                <img src="<?= assets('assets/img/table/calendar_blue.png'); ?>" alt="">
            </label>
            <input type="date" id="to_date">
            <span>To</span>
        </div>
        <button class="search_btn">Search</button>
        <button class="clear_btn">Clear</button>
    </div>
</div><!-- END_SERVICE_REQUESTS -->
<table>
    <thead>
        <tr>
            <th>Service ID</th>
            <th>Service Date</th>
            <th>Customer Details</th>
            <th>Service Provider</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>323436</td>
            <td>
                <div class="service_date">
                    <div>
                        <img src="<?= assets('assets/img/table/calendar.png'); ?>" alt="">
                        <p>09/04/2018</p>
                    </div>
                    <div>
                        <img src="<?= assets('assets/img/table/time.png'); ?>" alt="">
                        <p>12:00 - 18:00</p>
                    </div>    
                </div>
            </td>
            <td>
                <div class="customer_details">
                    <p>David Bough</p>
                    <div>
                        <img src="<?= assets('assets/img/table/home.png'); ?>" alt="">
                        <p>Musterstrabe 5,12345 Bonn</p>
                    </div>
                </div>
            </td>
            <td></td>
            <td><p class="new_status">New</p></td>
            <td>
                <div class="dropdown">
                    <button class="dropdown_btn"><i class="fas fa-ellipsis-v"></i></button>
                    <div class="dropdown_menu d_none">
                        <a href="">Edit</a>
                        <a href="">Reschedule</a>
                        <a href="">Cancel</a>
                        <a href="">Change SP</a>
                        <a href="">Escalate</a>
                        <a href="">History Log</a>
                        <a href="">Download Invoice</a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
