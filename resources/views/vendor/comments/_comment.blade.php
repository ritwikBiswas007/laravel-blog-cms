@inject('markdown', 'Parsedown')
@php($markdown->setSafeMode(true))



@if(isset($reply) && $reply === true)


<div id="comment-{{ $comment->getKey() }}"
    style="{{ $comment->child_id != null ? 'margin-top: 35px;border-left:1px solid rgba(0, 0, 0, 0.15);padding-left:35px':null }}"
    class="comment">


    @else
    <li id="comment-{{ $comment->getKey() }}" style="margin-top: 35px" class="depth-1 comment">
        @endif
        <div class="comment__avatar">
            <img class="avatar" width="50" height="50"
                src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?s=64"
                alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
        </div>
        <div class="comment__content">
            <div class="comment__info">
                <div class="comment__author">{{ $comment->commenter->name ?? $comment->guest_name }}</div>

                <div class="comment__meta">
                    <div class="comment__time">{{ $comment->created_at->diffForHumans() }}</div>
                    @can('reply-to-comment', $comment)
                    <div class="comment__reply">
                        <a class="comment-reply-link" id="reply-button-{{ $comment->getKey() }}"
                            href="javascript:void(0)">Reply</a>
                    </div>
                    @endcan
                </div>

            </div>
            {{-- <h5 class="mt-0 mb-1">{{ $comment->commenter->name ?? $comment->guest_name }} <small
                class="text-muted">-
                --}}
                {{-- {{ $comment->created_at->diffForHumans() }}</small></h5> --}}
            <div class="comment__text">{!! $markdown->line($comment->comment) !!}</div>
            <div>


                <form method="POST" id="reply-{{ $comment->getKey() }}" style="display:none"
                    action="{{ route('comments.reply', $comment->getKey()) }}">
                    @csrf
                    <div class="form-field">
                        {{-- <label for="message">Enter your message here:</label> --}}
                        <textarea placeholder="Your Message*"
                            class="full-width @if($errors->has('message')) is-invalid @endif" name="message"
                            rows="3"></textarea>

                        <small class="form-text text-muted"><a target="_blank"
                                href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a>
                            cheatsheet.</small>
                    </div>
                    <button type="submit" class="btn btn--primary btn-wide btn--large full-width">Submit
                        Reply</button>
                </form>
            </div>
            {{-- <div>
                @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}"
            class="btn btn-sm btn-link text-uppercase">Reply</button>
            @endcan
            @can('edit-comment', $comment)
            <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}"
                class="btn btn-sm btn-link text-uppercase">Edit</button>
            @endcan
            @can('delete-comment', $comment)
            <a href="{{ route('comments.destroy', $comment->getKey()) }}"
                onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
                class="btn btn-sm btn-link text-danger text-uppercase">Delete</a>
            <form id="comment-delete-form-{{ $comment->getKey() }}"
                action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
            @endcan
        </div> --}}

        {{-- @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Comment</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message">Update your message here:</label>
                            <textarea required class="form-control" name="message"
                                rows="3">{{ $comment->comment }}</textarea>
                            <small class="form-text text-muted"><a target="_blank"
                                    href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a>
                                cheatsheet.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Update</button>
                    </div>
                </form>
            </div>
        </div>
</div>
@endcan --}}

{{-- @can('reply-to-comment', $comment)
        <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Reply to Comment</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="message">Enter your message here:</label>
                    <textarea required class="form-control" name="message" rows="3"></textarea>
                    <small class="form-text text-muted"><a target="_blank"
                            href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a>
                        cheatsheet.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
                    data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Reply</button>
            </div>
        </form>
    </div>
</div>
</div>
@endcan --}}

{{-- <br />Margin bottom --}}

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()))
@foreach($grouped_comments[$comment->getKey()] as $child)
@include('comments::_comment', [
'comment' => $child,
'reply' => true,
'grouped_comments' => $grouped_comments
])
@endforeach
@endif

</div>
@if(isset($reply) && $reply === true)
</div>
@else
</li>
@endif




<script>
    document.getElementById("reply-button-{{ $comment->getKey() }}").addEventListener("click", function () {
    var displaySetting = document.getElementById("reply-{{ $comment->getKey() }}").style.display;
    
    if (displaySetting == 'block') {
        document.getElementById("reply-{{ $comment->getKey() }}").style.display = 'none';
    }else{
        document.getElementById("reply-{{ $comment->getKey() }}").style.display = 'block';
    }

    
        
    })
    

</script>