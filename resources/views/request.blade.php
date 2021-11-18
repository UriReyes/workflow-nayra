@inject('Screen','App\Models\Arworkflow\Screen')
<pre>
    [<a href="/start">Start a New Request</a>]
    <u>Request Id</u>: {{ $instance->getId() }}
    <u>Status</u>: {{ $request->status }}
    <u>Active Tasks</u>:
    @foreach ($instance->getTokens() as $token)
     - {{ $token->getOwnerElement()->getName() }} @if (in_array($token->getOwnerElement()->getBpmnElement()->localName, ['task', 'userTask'])) 
     [<a href="/complete/{{ $instance->getId() }}/{{ $token->getId() }}">complete</a>]@endif
    
    <u>Properties</u>:
    <pre>
        {{ json_encode($token->getOwnerElement()->getProperty('screenRef'), JSON_PRETTY_PRINT) }}
    </pre>
{{-- <u>Form</u>
<pre>
        @json((object) $Screen::find($token->getOwnerElement()->getProperty('screenRef'))->toArray()['config'], JSON_PRETTY_PRINT)
    </pre> --}}
@endforeach
<u>Data</u>:
@json((object) $instance->getDataStore()->getData(), JSON_PRETTY_PRINT)
</pre>
<script>
    // setInterval('location.reload()', 5000);
</script>
