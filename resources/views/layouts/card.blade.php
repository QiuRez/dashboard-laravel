@foreach ($ads as $ad)
    <div class="card mb-3">
        @if ($ad->AdPhoto)
            <div class="img">
                <img src="{{ url($ad->AdPhoto) }}" class="card-img-top" alt="...">
            </div>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $ad->Title }}</h5>
            <p class="card-text">{{ $ad->Description }}</p>
            <hr>
            <div class="d-flex flex-row justify-content-between">
                <p>Автор: {{ $ad->user->Username }}</p>
                <img onclick='window.location=`{{route("users.getUser", ["user" => $ad->user->UserID])}}`' src="{{ url($ad->user->UserPhoto) }}" alt="">
            </div>
            @if (Route::current()->getName() == 'home')
                <p class="text-muted mb-2">Категория: {{ $ad->category->CategoryName }}</p>
            @endif
            @auth
                @if (Auth::user()->Role == 'Администратор')
                    <a href="{{ route('ad.removeAd', ['adverisements' => $ad->AdID]) }}"
                        class="btn btn-outline-danger btn-sm">Delete</a>
                    <button data-bs-toggle="modal" data-bs-target="#ModalEdit_{{ $ad->AdID }}"
                        class="btn btn-outline-info btn-sm">Edit</button>
                @endif
            @endauth
        </div>
        @auth
            @if (Auth::user()->Role == 'Администратор')
                <div class="modal fade" id="ModalEdit_{{ $ad->AdID }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('ad.editAd') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="adId" value="{{ $ad->AdID }}">
                                    <div class="mb-3">
                                        <p class="form-label">Заголовок</p>
                                        <input type="text" name="title" class="form-control" id="adTitle"
                                            placeholder="Title" value="{{ $ad->Title }}">
                                    </div>
                                    <div class="mb-3">
                                        <p class="form-label">Объявление</p>
                                        <textarea class="form-control" id="adDescription" name="description" rows="3">{{ $ad->Description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <p class="form-label">Категория</p>
                                        <select class="form-select" name="category" aria-label="Default select example">
                                            @foreach ($categories as $item)
                                                <option @if ($item->CategoryID == $ad->CategoryID) selected @endif
                                                    value="{{ $item->CategoryID }}">{{ $item->CategoryName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endforeach
