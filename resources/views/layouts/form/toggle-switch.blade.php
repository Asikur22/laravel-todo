<label class="flex items-center cursor-pointer app-custom-checkbox">
    <!-- toggle -->
    <div class="relative">
        <!-- input -->
        <input name="{{$name}}" type="checkbox" class="sr-only" value="{{$value}}" @if($value == 1) checked @endif>
        <!-- line -->
        <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
        <!-- dot -->
        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
    </div>
    <!-- label -->
</label>