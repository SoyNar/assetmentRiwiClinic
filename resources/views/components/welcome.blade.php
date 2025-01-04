<div class="p-6 lg:p-8 bg-white border-b border-gray-200">

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Amateur Clinic
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">

    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="card shadow-sm" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Administrar horarios médicos</h5>
            <p class="card-text">Haz clic en el enlace para gestionar y crear los horarios de los médicos.</p>
            <a href="{{ route('show.allschedule') }}" class="btn btn-primary">Aquí</a>
        </div>
    </div>

    <div class="card shadow-sm" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Administrar de Usuarios</h5>
            <p class="card-text">Haz clic en el enlace para gestionar pacientes y medicos</p>
            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-4 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </a>
            @endif
        </div>
    </div>

    <div>
        <div>
            <h1>Citas agendadas</h1>
            <h3>Ver citas programadas y horarios </h3>
            <a href="{{route('appointment.show-doctor')}}">Click Aqui</a>
        </div>



    </div>
</div>
