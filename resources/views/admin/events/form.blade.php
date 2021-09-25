
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
    <div class="input-group">
        <input type="email" class="form-control" name="invite_user[]" placeholder="">
        <div class="input-group-append">
            <button class="btn btn-info" type="button" id="add_invite_people">Invite People</button>
        </div>
    </div>
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

    $(document).on('click','#add_invite_people',function(){

    });
</script>
@endsection
