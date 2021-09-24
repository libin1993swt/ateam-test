<div class="form-group {{ $errors->has('student_id') ? 'has-error' : ''}}">
    <label for="student_id" class="control-label">{{ 'Student Name' }}</label>
    <select name="student_id" class="form-control" id="student_id" >
        <option>Select Student</option>
        @foreach ($students as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}" {{ (isset($mark->student_id) && $mark->student_id == $optionValue->id) ? 'selected' : ''}}>{{ $optionValue->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('student_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('maths_mark') ? 'has-error' : ''}}">
    <label for="maths_mark" class="control-label">{{ 'Maths Mark' }}</label>
    <input class="form-control" name="maths_mark" type="number" id="maths_mark" value="{{ isset($mark->maths_mark) ? $mark->maths_mark : ''}}" >
    {!! $errors->first('maths_mark', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('science_mark') ? 'has-error' : ''}}">
    <label for="science_mark" class="control-label">{{ 'Science Mark' }}</label>
    <input class="form-control" name="science_mark" type="number" id="science_mark" value="{{ isset($mark->science_mark) ? $mark->science_mark : ''}}" >
    {!! $errors->first('science_mark', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('history_mark') ? 'has-error' : ''}}">
    <label for="history_mark" class="control-label">{{ 'History Mark' }}</label>
    <input class="form-control" name="history_mark" type="number" id="history_mark" value="{{ isset($mark->history_mark) ? $mark->history_mark : ''}}" >
    {!! $errors->first('history_mark', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('term') ? 'has-error' : ''}}">
    <label for="term" class="control-label">{{ 'Term' }}</label>
    <select name="term" class="form-control" id="term" >
        <option>Select Term</option>
    @foreach ($terms as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($mark->term) && $mark->term == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('term', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
