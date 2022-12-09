<div class="d-flex justify-content-between">

    <div>
        <img src="/images/clock.svg" alt="clock">
        <span>{{ $project->created_at}}</span>
    </div>
    <div>
        <img src="/images/list-check.svg" alt="Check">
        {{ count($project->tasks) }}
    </div>
    <div>
        @if ((auth()->user()->admin == 1) || (auth()->user()->admin == 2) )
        <form action="/projects/{{$project->id}}" method="POST">
            @method('DELETE')
            @csrf
            <input onclick="return confirm('Are you sure you want to delete ?')" type="submit" class="btn-delete" value="">
        </form>
        @endif
    </div>
</div>

<div>
    <div>
        <label><img src="/images/clock.svg" alt="clock"> الجلسه القادمه :</label>

        <span>{{ $project->nextdate }}</span>
    </div>
</div>
