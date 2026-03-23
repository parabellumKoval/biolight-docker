<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-title">Основное</li>
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-tools"></i> Товары</a>
	<ul class="nav-dropdown-items">
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon la la-th-list'></i> Список</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product-category') }}'><i class='nav-icon la la-list'></i> Категории</a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('feedback') }}'><i class='nav-icon la la-question'></i> Обратная связь</a></li>

<li class="nav-title">Контент</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>Страницы</span></a></li>
<!--
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i>Блог</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i> Записи</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon la la-list"></i> Категории</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tag"></i> Теги</a></li>
    </ul>
</li>
-->
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('article') }}'><i class='nav-icon la la-newspaper-o'></i> Блог</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu') }}'><i class='nav-icon la la-list'></i> Меню</a></li>

<li class="nav-title">Управление</li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Аутентификация</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Пользователи</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Роли</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Права</span></a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> Настройки</a></li>