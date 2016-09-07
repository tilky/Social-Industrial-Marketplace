<?php $count = Auth::user()->newMessagesCount(); ?>
@if($count > 0)
<span class="badge badge-danger">{!! $count !!}</span>
@endif
