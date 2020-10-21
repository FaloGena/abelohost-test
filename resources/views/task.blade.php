@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mt-5 text-center">
            <h3>Edit task</h3>
        </div>
    </div>
    <form action="/tasks/{{$task->id}}" method="POST" class="col-12 task-edit-form">
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="form-group col-12">
                <label for="taskName-input">Task name</label>
                <input type="text" name="name" id="taskName-input" class="form-control form-control-lg" placeholder="Name *"
                       value="{{$task->name}}" required>
            </div>
            <div class="form-group col-12">
                <label for="taskDescription-input">Task description</label>
                <input type="text" name="description" id="taskDescription-input" class="form-control" placeholder="Description"
                       value="{{$task->description ?? ''}}">
            </div>
            <div class="form-check col-6">
                @if (($task->done_at !== null))
                    <input type="checkbox" name="done" id="taskDone-input" class="" checked>
                    <label for="taskDone-input" class="form-check-label">Mark as completed (Done at {{$task->done_at->format('h:i d.m.Y')}})</label>
                @else
                    <input type="checkbox" name="done" id="taskDone-input" class="">
                    <label for="taskDone-input" class="form-check-label">Mark as completed</label>
                @endif
            </div>
            <div class="form-group col-6 task-date text-right">
                <span>Created: {{$task->created_at->format('h:i d.m.Y')}}</span>
            </div>
            <div class="col-12 task-edit-form__submit-button">
                <button type="submit" class="btn btn-secondary btn-lg float-right">Submit</button>
            </div>
        </div>
    </form>
    <form action="/tasks/{{$task->id}}" method="POST" class="col-12 mt-4 task-delete-form">
        {{csrf_field()}}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger btn-lg float-right">Delete task</button>
    </form>
@endsection
