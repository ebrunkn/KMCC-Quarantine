<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <form id="data-form" action="{{url('buildings/save')}}" callback="{{url('buildings')}}">

        <div style="width:100%;">
            <input type="text" placeholder="building name" name="building_name">
            <span id="form-error-building_name"></span>
        </div>

        <div style="width:100%;">
            <input type="text" placeholder="Total rooms" name="total_rooms">
            <span id="form-error-total_rooms"></span>
        </div>

        <div style="width:100%;">
            <input type="text" placeholder="Occupancy" name="occupancy">
            <span id="form-error-occupancy"></span>
        </div>

        <div style="width:100%;">
            <input type="text" placeholder="Contact Person name" name="name">
            <span id="form-error-name"></span>
        </div>

        <div style="width:100%;">
            <input type="text" placeholder="Phone" name="phone">
            <span id="form-error-phone"></span>
        </div>

        @csrf

        <button type="submit" id="data-form-save-btn">Save</button>

    </form>

    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
    {!! Html::script('form-handle/ajax-form.js') !!}
</body>
</html>