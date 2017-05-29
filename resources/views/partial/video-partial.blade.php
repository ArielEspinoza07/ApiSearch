@foreach($videos as $video)
    <div class="card col s12">
       <div class="row">
           <div class="col s12">
               <iframe src="{{$video->iframe}}" width="600px" height="320px" frameborder="0"></iframe>
           </div>
           <div class="col s12">
               <p>{{$video->tittle}}</p>
               <p><a href="{{$video->link}}" target="_blank">Watch the video on youtube</a></p>
               <p>{{$video->description}}</p>
           </div>
       </div>
    </div>
@endforeach