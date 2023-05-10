@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="/" method="GET" class="mt-5">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label ">Enter number pin code</label>
                        <input name="number_pin" value="{{ $data['pin'] }}" class="form-control form-control-sm" type="number">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Type code</label>
                        <select class="form-control form-control-sm" name="type">
                            <option @if($data['type'] == 'number')  selected @endif value="number">Number</option>
                            <option @if($data['type'] == 'numberText')  selected @endif value="numberText">Number and
                                text
                            </option>
                        </select>
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary btn-sm" type="submit">Change</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="pin-code">
                    @for ($x = 1; $x <= $data['pin']; $x++)
                    <input type="password" id="input{{ $x }}" maxlength="1" class="form-control"
                           onkeypress="validate(event)" @if ($x == 1)  autofocus @endif >
                    @endfor
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script>
    function validate(evt) {
        var theEvent = evt || window.event;
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        @if($data['type'] == 'number')
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
        @endif
    }

    var pinContainer = document.querySelector(".pin-code");
    pinContainer.addEventListener('keyup', function (event) {
        var target = event.srcElement;
        var myLength = target.value.length;

        if (myLength === 0) {
            var next = target;
            while (next = next.previousElementSibling) {
                if (next == null) break;
                if (next.tagName.toLowerCase() == "input") {
                    next.focus();
                    break;
                }
            }
        }
    }, false);
    const inputs = document.querySelectorAll(".pin-code input");
    inputs.forEach((input, key) => {
        if (key !== 0) {
            input.addEventListener("click", function () {
                inputs[0].focus();
            });
        }
        input.addEventListener("keyup", function () {
            if (input.value) {
                if (key == {{ $data['setkey'] }}) {
                    const userCode = [...inputs].map((input) => input.value).join("");
                } else {
                    inputs[key + 1].focus();
                }
            }
        });
    });
    document.getElementById('input1').addEventListener('paste', function(e) {
        e.preventDefault();
        var pastedData = e.clipboardData.getData('text');
        var digits = pastedData.split('');

        if (digits.length == {{ $data['pin'] }}) {
            @for ($x = 1; $x <= $data['pin']; $x++)
            document.getElementById('input{{ $x }}').value = digits[{{ $x-1 }}];
            @endfor
        }
    });

</script>
@endsection