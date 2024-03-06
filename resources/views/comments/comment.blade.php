{{-- Комментарии --}}
<div class="d-flex justify-content-lg-center row">
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section">
            @foreach ($comments as $comment)
                <div class="comment p-2">
                    <div class="d-flex flex-row user-info gap-2">
                        <img class="rounded-circle" onclick='window.location=`{{route("users.getUser", ["user" => $comment->author->UserID])}}`'
                        src="{{url($comment->author->UserPhoto)}}" width="40">
                        <div class="d-flex flex-column justify-content-start ml-2">
                            <span class="d-block font-weight-bold name">{{ $comment->author->Username }}</span>
                            <span class="date text-black-50">Shared publicly - {{ $comment->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text mx-3 my-3">
                            {{$comment->Description}}
                        </p>
                    </div>
                </div>
            @endforeach
            {{-- <div class="bg-white">
                <div class="d-flex flex-row fs-12">
                    <div class="like p-2 cursor">
                        <i class="fa fa-thumbs-o-up"></i>
                        <span class="ml-1">Like</span>
                    </div>
                    <div class="like p-2 cursor">
                        <i class="fa fa-commenting-o"></i>
                        <span class="ml-1">Comment</span>
                    </div>
                    <div class="like p-2 cursor">
                        <i class="fa fa-share"></i>
                        <span class="ml-1">Share</span>
                    </div>
                </div>
            </div> --}}
            @auth
            <div class="bg-light p-2">
                <div class="d-flex flex-row align-items-start gap-2">
                    <img class="rounded-circle" src="{{url(Auth::user()->UserPhoto)}}" width="40">
                    <textarea class="form-control ml-1 shadow-none textarea"></textarea>
                </div>
                <div class="d-flex flex-row mt-2 text-right gap-2">
                    <button class="btn btn-primary btn-sm shadow-none" type="button">Post comment</button>
                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none"type="button">Cancel</button>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

{{-- Конец комментариев --}}
