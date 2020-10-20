<div class="row my-4 shadow bg-main-block rounded time">
    <div class="col-xl-4 average-time my-auto text-center">
        <div class="col-12 h-75 count-amount">
            <span>{{$user->avgTime}}</span>
        </div>
        <div class="col-12 count-description">
            <span>Average per task</span>
        </div>
    </div>
    <div class="col-xl-4 most-time my-auto text-center">
        <div class="col-12 h-75 count-amount">
            <span class="text-danger">{{$user->maxTime}}</span>
        </div>
        <div class="col-12 count-description">
            <span>Most spent</span>
        </div>
    </div>
    <div class="col-xl-4 least-time my-auto text-center">
        <div class="col-12 h-75 count-amount">
            <span class="text-success">{{$user->minTime}}</span>
        </div>
        <div class="col-12 count-description">
            <span>Least spent</span>
        </div>
    </div>
</div>
