<x-app-layout>
<div class="mx-auto">
    <div class="bg-white shadow-md rounded my-10">
        <table class="text-center w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">{{trans('user_table.name')}}</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">{{trans('user_table.email')}}</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">{{trans('user_table.created_at')}}</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">{{trans('user_table.type')}}</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">{{trans('user_table.actions')}}</th>
            </tr>
            </thead>


            <tbody>
            @foreach($users as $user)
            <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $user->email}}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $user->created_at}}</td>
                <td class="py-4 px-6 border-b border-grey-light">{{ $user->is_admin ?'Admin':'Usuario'}}</td>
                <td class="py-4 px-6 border-b border-grey-light">
                    <a href="{{ route('users.show',$user) }}"  class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green-600 hover:bg-green-400 ">Mas</a><!--<em class="fas fa-edit"></em>-->
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->onEachSide(5)->links() }}
</div>
</x-app-layout>
