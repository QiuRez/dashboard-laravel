{{-- Комментарии --}}
<div class="d-flex justify-content-lg-center row">
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section">
            @if (count($comments))
                @foreach ($comments as $comment)
                    <div class="comment p-2 my-1">
                        <div class="d-flex flex-row user-info gap-2">
                            <img class="rounded-circle"
                                onclick=window.location=`{{ route('users.getUser', ['user' => $comment->author->UserID]) }}`
                                src="{{ url($comment->author->UserPhoto) }}" width="40">
                            <div class="d-flex flex-column justify-content-start ml-2">
                                <span class="d-block font-weight-bold name">{{ $comment->author->Username }}</span>
                                <span class="date text-black-50">Shared publicly -
                                    {{ $comment->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="comment-text mx-3 my-2">
                                {{ $comment->Description }}
                            </p>
                        </div>
                        @auth
                            <div class="bg-white">
                                <div class="d-flex flex-row fs-12">
                                    @if (Auth::user()->Role == 'Администратор' || Auth::id() == $comment->AuthorUserID)
                                        <div class="like p-2 cursor">
                                            <i class="fa fa-thumbs-o-up"></i>
                                            <a href="{{ url('/comment/delete/' . $comment->id) }}"
                                                class="ml-1 btn-comment-delete">Delete</a>
                                        </div>
                                    @endif
                                    {{-- <div class="like p-2 cursor">
                        <i class="fa fa-commenting-o"></i>
                        <span class="ml-1">Comment</span>
                    </div>
                    <div class="like p-2 cursor">
                        <i class="fa fa-share"></i>
                        <span class="ml-1">Share</span>
                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endauth
                @endforeach
            @else
                <h5 class="text-center">Комментариев ещё нет :(</h5>
            @endif
            @auth
                <div class="bg-light p-2">
                    <form action="{{ url('comment/create') }}" method="post">
                        @csrf
                        <input type="hidden" name="AuthorUserID" value="{{ Auth::id() }}">
                        <input type="hidden" name="TargetUserID" value="{{ $user->getAttribute('UserID') }}">
                        <div class="d-flex flex-row align-items-start gap-2">
                            <img class="rounded-circle" src="{{ url(Auth::user()->UserPhoto) }}" width="40">
                            <textarea class="form-control ml-1 shadow-none textarea" name="Description"></textarea>
                        </div>
                        <div class="mx-5 d-flex flex-row mt-2 text-right gap-2">
                            <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>

{{-- Конец комментариев --}}
