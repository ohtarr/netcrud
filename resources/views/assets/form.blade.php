<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Manufacturer:</strong>
            {!! Form::text('manufacturer', null, array('placeholder' => 'Manufacturer','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Model:</strong>
            {!! Form::text('model', null, array('placeholder' => 'Model','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Serial:</strong>
            {!! Form::text('serial', null, array('placeholder' => 'Serial','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Vendor Name:</strong>
            {!! Form::text('vendor_name', null, array('placeholder' => 'Vendor Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Location ID:</strong>
            {!! Form::text('location_id', null, array('placeholder' => 'Location ID','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
