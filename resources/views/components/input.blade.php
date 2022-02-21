@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}  @error($attributes->get('name')) class="block w-full border-red-600" @enderror  {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
