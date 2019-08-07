<!DOCTYPE html>
<html>
<head>
    <title>Map Example - JSON Data</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Store-Locator') }}/dist/assets/css/storelocator.css" />
</head>

<body>

<div class="bh-sl-container">
    <div id="page-header">
        <h1 class="bh-sl-title">Using Chipotle as an Example</h1>
        <p>I used locations around Minneapolis and the southwest suburbs. So, for example, Edina, Plymouth, Eden Prarie, etc. would be good for testing the functionality.
            You can use just the city as the address - ex: Edina, MN.</p>
    </div>

    <div class="bh-sl-form-container">
        <form id="bh-sl-user-location" method="post" action="">
            <div class="form-input">
                <label for="bh-sl-address">Enter Address or Zip Code:</label>
                <input type="text" id="bh-sl-address" name="bh-sl-address" />
            </div>

            <button id="bh-sl-submit" type="submit">Submit</button>
        </form>
    </div>

    <div id="bh-sl-map-container" class="bh-sl-map-container">
        <div id="bh-sl-map" class="bh-sl-map"></div>
        <div class="bh-sl-loc-list">
            <ul class="list"></ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ asset('public/Store-Locator/dist/assets/js/libs/handlebars.min.js') }}"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCoYHFhB9SbbUGXJ9jzhmSMihCJOOoQFyY"></script>
<script src="{{ asset('public/Store-Locator/dist/assets/js/plugins/storeLocator/jquery.storelocator.js') }}"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#bh-sl-map-container').storeLocator({
            dataType: 'json',
            dataLocation: 'http://127.0.0.1/Store-Locator/dist/data/locations.json'
        });
    });
</script>

</body>
</html>
