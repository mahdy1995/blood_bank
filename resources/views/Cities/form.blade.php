
    <div class="form-group">
            <label for="name">Name of City</label>
            {!! Form::text('name',null,[
                'class' => 'form-control'
            ]) !!}
            {{!! Form::select('name', App('Governorate')->pluck('name', 'id'), null, ['placeholder'=>'Choose Governorate']) !!}}
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Add !</button>
        </div>