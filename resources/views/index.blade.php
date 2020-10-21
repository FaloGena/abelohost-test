@extends('layouts.main')
@section('content')
    @guest
        <div class="not-logged-main">
            <div class="big-name text-center">
                <span>TaskWatch</span>
            </div>
            <div class="need-login text-center">
                <span>You have to <a href="#" data-toggle="modal" data-target="#loginModal">Log in</a> or <a
                        href="/register">create an account</a> to start using the service!</span>
            </div>
        </div>
    @endguest
    @auth
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="row shadow rounded bg-main-block add-record p-3">
                    <div class="col-12 text-center">
                        <h3>Add new task</h3>
                    </div>
                    <form class="col-12" method="POST" action="/tasks">
                        {{csrf_field()}}
                        <input type="text" name="name" class="form-control mb-2" placeholder="Task name *">
                        <input type="text" name="description" class="form-control mb-2" placeholder="Task description">
                        <button type="submit" class="btn btn-lg btn-secondary btn-block">Add</button>
                    </form>
                </div>
                <div class="row mt-4 tasks-list">
                    <div class="container text-center">
                        <h3>All tasks</h3>
                    </div>
                    @foreach($tasks as $task)
                        <div class="row w-100 my-2 mx-0 rounded bg-main-block shadow task-item">
                            <div class="col-2 task-checkbox my-auto text-center">
                                @if($task->done_at !== null)
                                    <button data-id="{{$task->id}}" class="rounded checked">&#10003;</button>
                                @else
                                    <button data-id="{{$task->id}}" class="rounded unchecked"></button>
                                @endif
                            </div>
                            <div class="col-10 pl-0 py-2 task-body" data-id="{{$task->id}}">
                                <div class="col-12 pt-2 task-name">
                                    <h5>{{$task->name}}</h5>
                                </div>
                                <div class="col-12 task-description">
                                    <span>{{$task->description}}</span>
                                </div>
                                <div class="col-12 task-date text-right">
                                    <span>{{$task->created_at->format('h:i d.m.Y')}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="container">
                        {{$tasks->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1 stats">
                <div class="row mb-4 shadow bg-main-block rounded count">
                    <div class="col-6 all-count my-auto text-center">
                        <div class="col-12 h-75 count-amount">
                            <span>{{$user->tasks_count}}</span>
                        </div>
                        <div class="col-12 count-description">
                            <span>Total added</span>
                        </div>
                    </div>
                    <div class="col-6 done-count my-auto text-center">
                        <div class="col-12 h-75 count-amount">
                            <span class="text-success">{{$user->done_tasks}}</span>
                        </div>
                        <div class="col-12 count-description">
                            <span>Total done</span>
                        </div>
                    </div>
                </div>
                @include('layouts.main.stats-time')
                <div class="row mt-4 shadow bg-main-block rounded">
                    <div class="col-12 chart">
                        <canvas id="taskChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('after-scripts')
    @auth
        @include("layouts.main.task-chart")
    @endauth
@endsection
