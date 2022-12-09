{{-- --}}

<div>

    <form class="x" style="margin: auto;">
        <input wire:model="search" wire:keydown.debounce.500ms="findProfile('{{$search}}')" type="text" class="xinput" style="margin: auto;"
               id="search" type="search" pattern=".*\S.*" required>
        <span style="margin: auto;" class="caret"></span>
    </form>
    @if ($results!=null)
    <div class="row mt-5 bg-red">
        @forelse ($results as $project)
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card p-3" style="    height: 260px;">
                <div class="status mb-2 p-2">
                    @switch($project['status'])
                    @case(1)
                    <span class="text-success">مكتمل</span>
                    @break
                    @case(2)
                    <span class="text-danger">ملغى</span>
                    @break
                    @default
                    <span class="text-warning">قيد الانجاز</span>
                    @endswitch
                </div>
                <div class="card-title">
                    <a href=" projects/{{$project['id']}}" class="h3 text-decoration-none">{{ $project['username']}}</a>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark fs-5">
                        {{Str::limit($project['description'],50)}}
                    </p>
                </div>
                <div class="d-flex justify-content-between">

                    <div>
                        <img src="/images/clock.svg" alt="clock">
                        <span>{{ $project['created_at']}}</span>
                    </div>
                    <div>
                        <img src="/images/list-check.svg" alt="Check">
                        {{ count($project['tasks']) }}
                    </div>
                    <div>
                        <form onclick="return confirm('Are you sure you want to delete ?')" action="/projects/{{$project['id']}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn-delete" value="">
                        </form>
                    </div>
                </div>

                <div>
                    <div>
                        <label><img src="/images/clock.svg" alt="clock"> الحلسه القادمه :</label>
                        <span>{{ $project['nextdate'] }}</span>
                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6 card align-items-center p-3 mt-5" style="width: 75%;">
                <div class="card-title">
                    <h4 class="h2">صفحة الحالات فارغه</h4>
                </div>
                <div class="card-body">
                    <a href="projects/create" class="btn btn-primary lg" style="border-radius: 0px"> أضف حالات جديدة</a>
                </div>
            </div>
        </div>
        @endforelse
        @else

        @endif
    </div>
