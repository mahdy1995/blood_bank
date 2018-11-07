
    <div class="form-group">
            <label for="name">Name of City</label>
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <label for="governorate">Select Governorate</label>
            {!! Form::select('governorate_id', $governorates, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit !</button>
        </div>
