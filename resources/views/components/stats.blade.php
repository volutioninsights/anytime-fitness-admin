{{-- <div class="col"> --}}
    <div class="panel panel-primary">
        <div class='panel-body statCont'>
                <div class='row stats flex-nowrap'>
                @foreach ($stats as $stat)
                    @if (($loop->index % 4) === 0 && $loop->index !== 0)
                        </div>
                        <div class='row stats flex-nowrap'>
                    @endif
                    <div class="stat col-xs-6 col-sm-4 col-md-3">
                        <h4 class="stat-title">{{$stat['statTitle']}}</h4>
                        <h3 class="stat-amt counter" data-currency="{{(@$stat['currency']) ? 1 : 0 }}" data-percent="{{(@$stat['percent']) ? 1 : 0 }}" data-count={{$stat['stat']}}>0</h3>
                    </div>
                @endforeach
                        </div>
        </div>
    </div>
{{-- </div> --}}