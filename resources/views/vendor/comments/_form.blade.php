<div class="card">
    <div class="card-body">
        @if($errors->has('commentable_type'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_type') }}
        </div>
        @endif
        @if($errors->has('commentable_id'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_id') }}
        </div>
        @endif
        <h3 class="h2">Add Comment <span>Your email address will not be published</span></h3>
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
            <div class="form-field">
                <input type="text" placeholder="Your name*"
                    class="full-width @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />
                @error('guest_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-field">
                <input type="email" placeholder="Your email*"
                    class="full-width @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />
                @error('guest_email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif

            <div class="form-field">
                {{-- <label for="message">Enter your message here:</label> --}}
                <textarea placeholder="Your Message*" class="full-width @if($errors->has('message')) is-invalid @endif"
                    name="message" rows="3"></textarea>

                <small class="form-text text-muted"><a target="_blank"
                        href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a>
                    cheatsheet.</small>
            </div>
            <button type="submit" class="btn btn--primary btn-wide btn--large full-width">Submit</button>
        </form>
    </div>
</div>
<br />