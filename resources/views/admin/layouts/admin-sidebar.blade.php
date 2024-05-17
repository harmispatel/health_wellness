 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     @php
         $currentRouteName = Route::currentRouteName();

         $urls = [];
         $urls[] = Request::segment(2);
         $urls[] = Request::segment(3);
         $url = array_filter($urls);
         $role_id = Auth::user()->role_id;
         $permission_ids = App\Models\RoleHasPermissions::where('role_id', $role_id)->pluck('permission_id')->toArray();
         $role = Spatie\Permission\Models\Permission::where('name', 'roles')->first();
         $user = Spatie\Permission\Models\Permission::where('name', 'users')->first();

     @endphp

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link
            {{-- Active Tab Class --}}
            {{ in_array('dashboard', $url) ? 'active-tab' : '' }}"
                 href="{{ route('dashboard') }}">
                 <i
                     class="bi bi-grid
                {{-- Icon Tab Class --}}
                {{ in_array('dashboard', $url) ? 'icon-tab' : '' }}"></i>
                 <span>{{ __('Dashboard') }}</span>
             </a>
         </li>

         <li class="nav-item">
             <a href="{{ route('question.index') }}"
                 class="nav-link {{ in_array($currentRouteName, ['question.index', 'question.create', 'question.edit']) ? 'active-tab' : '' }}">
                 <i
                     class="bi bi-question-circle  {{ in_array($currentRouteName, ['question.index', 'question.create', 'question.edit']) ? 'active-tab' : '' }}"></i><span>{{ trans('label.question')}}</span>
             </a>
         </li>

         <li class="nav-item">
            <a href="{{ route('advertisement.index') }}"
                class="nav-link {{ in_array($currentRouteName, ['advertisement.index', 'advertisement.create']) ? 'active-tab' : '' }}">
                <i
                    class="bi bi-file-earmark-medical {{ in_array($currentRouteName, ['advertisement.index', 'advertisement.create']) ? 'active-tab' : '' }}"></i><span>{{ trans('label.advertisement')}}</span>
            </a>
        </li>

         {{-- User Tab --}}
         @if ( in_array($user->id, $permission_ids))
             <li class="nav-item">
                 <a class="nav-link {{ Route::currentRouteName() != 'users' && Route::currentRouteName() != 'users.create' && Route::currentRouteName() != 'users.edit' ? 'collapsed' : '' }} {{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'active-tab' : '' }}"
                     data-bs-target="#users-nav" data-bs-toggle="collapse" href="#"
                     aria-expanded="{{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'true' : 'false' }}">
                     <i
                         class="fa-solid fa-users {{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'icon-tab' : '' }}"></i><span>{{ trans('label.user') }}</span><i
                         class="bi bi-chevron-down ms-auto {{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'icon-tab' : '' }}"></i>
                 </a>
                 <ul id="users-nav"
                     class="nav-content sidebar-ul collapse {{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'show' : '' }}"
                     data-bs-parent="#sidebar-nav">
                     @if (in_array($user->id, $permission_ids))
                         <li>
                             <a href="{{ route('users') }}"
                                 class="{{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'active-link' : '' }}">
                                 <i
                                     class="{{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'users.create' || Route::currentRouteName() == 'users.edit' ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Users</span>
                             </a>
                         </li>
                     @endif
                 </ul>
             </li>
         @endif
         <!-- End User Tab -->

         {{-- Setting --}}
         <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName() != 'roles' && Route::currentRouteName() != 'roles.create' && Route::currentRouteName() != 'roles.edit' ? 'collapsed' : '' }} {{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'active-tab' : '' }}"
                 data-bs-target="#roles-nav" data-bs-toggle="collapse" href="#"
                 aria-expanded="{{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'true' : 'false' }}">
                 <i
                     class="fa-solid fa-cog {{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'icon-tab' : '' }}"></i><span>{{ trans('label.setting') }}</span><i
                     class="bi bi-chevron-down ms-auto {{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'icon-tab' : '' }}"></i>
             </a>
             <ul id="roles-nav"
                 class="nav-content sidebar-ul collapse {{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'show' : '' }}"
                 data-bs-parent="#sidebar-nav">
                 @if (in_array($role->id, $permission_ids))
                     <li>
                         <a href="{{ route('roles') }}"
                             class="{{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'active-link' : '' }}">
                             <i
                                 class="{{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>{{ trans('label.roles') }}</span>
                         </a>
                     </li>
                 @endif
             </ul>
         </li>
         <!-- End Setting -->

     </ul>

 </aside>
 <!-- End Sidebar-->
