<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($student->name) ? $student->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dob') ? 'has-error' : ''}}">
    <label for="age" class="control-label">{{ 'DOB' }}</label>
    <input class="form-control" name="age" type="date" id="age" value="{{ isset($student->dob) ? $student->dob : ''}}" >
    {!! $errors->first('dob', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    <label for="gender" class="control-label">{{ 'Gender' }}</label>
    <select name="gender" class="form-control" id="gender" >
        <option>Select Gender</option>
    @foreach ($genders as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($student->gender) && $student->gender == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    <label for="phone_number" class="control-label">{{ 'Mob Number' }}</label>
    <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ isset($student->phone_number) ? $student->phone_number : ''}}" >
    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($student->email) ? $student->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
    <label for="gender" class="control-label">{{ 'Country' }}</label>
    <select name="country_id" class="form-control" id="country_id" >
        <option>Select Country</option>
    @foreach ($countries as $optionKey => $country)
        <option value="{{ $country->id }}" {{ (isset($student->gender) && $student->gender == $optionKey) ? 'selected' : ''}}>{{ $country->name }}</option>
    @endforeach
    </select>
    {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
    <label for="gender" class="control-label">{{ 'State' }}</label>
    <select name="state_id" class="form-control" id="state_id" >
        <option>Select Country</option>
    @foreach ($countries as $optionKey => $country)
        <option value="{{ $country->id }}" {{ (isset($student->gender) && $student->gender == $optionKey) ? 'selected' : ''}}>{{ $country->name }}</option>
    @endforeach
    </select>
    {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

<script>
    $(document).on('change','#country_id',function(){
        var country_id = $('#country_id').find(":selected").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('states-list') }}",
            type: "post",
            data: {country_id:country_id} ,
            success: function (response) {
                if(response.status) {
                    var states = response.states;
                    $('#state_id').empty();
                    if(states.length > 0) {
                        var stateSelect = $('#state_id');
                        $.each(states, function(key, value) {
                            var option = $("<option/>", {
                                value: value.id,
                                text: value.name
                            });
                            stateSelect.append(option);
                        });
                    }
                }
            // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    
</script>
