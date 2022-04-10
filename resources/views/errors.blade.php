<?php

/**
 * @var array $errors
 */
?>
@if($errors)
    <div class="col-md-12">
        <div class="alert  alert-danger">
            <ul>
                @foreach($errors as $e)
                    <li>{{$e}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
