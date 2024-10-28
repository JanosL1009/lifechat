@extends('layouts.login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
<div class="container">
    <div class="logo">
        <img src="{{ asset('images/lifechat.gif') }}" alt="Lifechat Logó">
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="form-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h2>Regisztráció</h2>

            <div class="form-group">
                <label for="username">Felhasználónév</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email-cím</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="gender">Nem:</label>
                <div class="gender-options">
                    <div>
                        <input type="radio" id="male" name="gender" value="1">
                        <label for="male">Férfi</label>
                    </div>
                    <div>
                        <input type="radio" id="female" name="gender" value="2">
                        <label for="female">Nő</label>
                    </div>
                    <div>
                        <input type="radio" id="other" name="gender" value="3">
                        <label for="other">Egyéb</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="birthdate">Születési dátum:</label>
                <div class="birthdate-options">
                    <select id="year" name="year">
                        <option value="">Év</option>
                        <script>
                            for (let year = 2024; year >= 1930; year--) {
                                document.write(`<option value="${year}">${year}</option>`);
                            }
                        </script>
                    </select>

                    <select id="month" name="month" onchange="updateDays()">
                        <option value="">Hónap</option>
                        <option value="1">Január</option>
                        <option value="2">Február</option>
                        <option value="3">Március</option>
                        <option value="4">Április</option>
                        <option value="5">Május</option>
                        <option value="6">Június</option>
                        <option value="7">Július</option>
                        <option value="8">Augusztus</option>
                        <option value="9">Szeptember</option>
                        <option value="10">Október</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                    <select id="day" name="day">
                        <option value="">Nap</option>
                    </select>
                </div>
            </div>           
            <div class="form-group">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Jelszó megerősítése</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        Elfogadom a <a href="#" target="_blank">Chat szabályzatot</a>.
                    </label>
                </div>
            </div> 
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="priv_policy" name="priv_policy" required>
                    <label for="priv_policy">
                        Elfogadom az <a href="#" target="_blank">Adatkezelési tájékoztatót</a>.
                    </label>
                </div>
            </div> 
            <button type="submit" class="btn-register">Regisztráció</button>
        </form>
        <a href="{{ route('login') }}" class="link">Már van fiókod? Jelentkezz be!</a>
    </div>
</div>
<script>
    const daySelect = document.getElementById("day");
    const monthSelect = document.getElementById("month");
    const yearSelect = document.getElementById("year");

    function initializeDays() {
        daySelect.innerHTML = '<option value="">Nap</option>';
    }

    function updateDays() {
        const month = parseInt(monthSelect.value);
        const year = parseInt(yearSelect.value);

        initializeDays();

        if (month && year) {
            let daysInMonth;

            if (month === 2) {
                daysInMonth = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0) ? 29 : 28;
            } else {
                daysInMonth = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
            }

            for (let day = 1; day <= daysInMonth; day++) {
                daySelect.innerHTML += `<option value="${day}">${day}</option>`;
            }
        }
    }

    monthSelect.addEventListener('change', updateDays);
    yearSelect.addEventListener('change', updateDays);

    initializeDays();
</script>

@endsection
