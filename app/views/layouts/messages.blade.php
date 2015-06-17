@if ($errors->any())
    <div class="ui error message">
        <ul>
            {{ implode('', $errors->all('<li>:message</li>')) }}
        </ul>
    </div>
@endif