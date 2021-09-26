
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($event->name) ? $event->name : ''}}"placeholder="Event Name" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="control-label">{{ 'Start Date' }}</label>
    <input class="form-control datepicker" name="start_date" type="text" id="start_date" value="{{ isset($event->start_date) ? date('d-m-Y',strtotime($event->start_date)) : ''}}" readonly required>
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="control-label">{{ 'End Date' }}</label>
    <input class="form-control datepicker" name="end_date" type="text" id="end_date" value="{{ isset($event->end_date) ? date('d-m-Y',strtotime($event->end_date)) : ''}}" readonly required>
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label class="control-label">{{ 'Invite People' }}</label>
</div>
    @if(!empty($event->invities_events))
        @foreach($event->invities_events as $invitee)
        <div class="form-group">
            <div class="input-group">
                <input type="email" class="form-control" name="invite_user[]" placeholder="" value="{{ getInviteeEmail($invitee->invitees_id) }}">
                <div class="input-group-append">
                    <button class="btn btn-danger remove_invite_people" type="button">Remove Invite People</button>
                </div>
            </div>
        </div>  
        @endforeach
    @endif

<div class="form-group">
    <div class="input-group">
        <input type="email" class="form-control invite_user" name="invite_user[]" placeholder="">
        <div class="input-group-append">
            <button class="btn btn-info add_invite_people" type="button">Add Invite People</button>
        </div>
    </div>    
</div>

<div class="add_div">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

@section('js_content')
<script>
    $(function() {
        $( ".datepicker").datepicker({
            dateFormat: "dd-mm-yy",
        });
    });

    $(document).on('click','.add_invite_people',function(){
        var value = $(this).closest('.invite_user').val();
        if(value != '') {
            var valid = true;
            var error = 0;
            $('.invite_user').each(function(){
                var email = $(this).val();
                valid = isEmail(email);
                if(!valid) {
                    alert(email+ 'is not a valid email id .Please enter a valid invitees mail id.');
                    error++;
                }
            });
            if(error = 0) {
                $(this).text('Remove Invite People');
                $(this).addClass('remove_invite_people').removeClass('add_invite_people');
                $(this).addClass('btn-danger').removeClass('btn-info');

                var content = '<div class="form-group"> <div class="input-group">';
                content += '<input type="email" class="form-control" name="invite_user[]" placeholder="">';
                content += '<div class="input-group-append">';
                content += '<button class="btn btn-info add_invite_people" type="button">Add Invite People</button>';
                content += '</div> </div> </div>';
               
                $('.add_div').append(content);
            } 
        }else {
            alert('Please enter a valid invitees mail id.');
        }
    });

    $(document).on('click','.remove_invite_people',function(){
        $(this).closest('.form-group').remove();
    });

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
</script>
@endsection
