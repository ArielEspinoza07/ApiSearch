@foreach($songs as $song)
    <div class="card col s12">
        <div class="row">
            <div class="col s6">
                <img class="responsive-img" src="{{$song->album->cover_medium}}">
            </div>
            <div class="col s6">
                <p>Artist: {{$song->artist->name}}</p>
                <p>Album: {{$song->album->title}}</p>
                <p>Title: {{$song->title}}</p>
                <p><a href="{{$song->link}}" target="_blank">Listen on deezer</a></p>
                <audio controls>
                    <source src="{{$song->preview}}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
@endforeach