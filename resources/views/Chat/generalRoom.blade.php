@extends('layouts.app')
@section('content')


<style>
    .min32px {
    width: 32px;
    height: 32px;
  
    animation: pulse 1s infinite ease-in-out;
}
#sendmessage
{
    max-height: 35px;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2); /* Növelje meg a méretet 20%-kal */
        opacity: 0.7; /* Csökkentse az áttetszőséget */
    }
}


  

</style>

<div class="row">
    <div class="col-12 col-md-9">
        
        <div class="row">
            <div class="chat-messages" id="chatMessages">
                <p><span class="moderator">ModiUser-Moderator:</span> Szépen írjon mindenki</p>
                <p><span class="user1">User1:</span> Hello, mi van itt?</p>
                <p><span class="user2">User2:</span> Szia, hogy vagy??</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-10">
                
                    {{-- <input type="text" placeholder="Írj üzenetet..." name="sendmessage" id="sendmessage" /> --}}
                    <textarea name="sendmessage" id="sendmessage" class="form-control" ></textarea>
                   
                
            </div>
            <div class="col-12 col-md-2">
                <button id="msgSendBtn">Küldés</button>
            </div>
            
        </div>
               
           
           
       
    </div>

    <div class="col-12 col-md-3">
        <div class="user-list">
                 
        </div>
    </div>
</div>





<script>
       function adjustChatHeight() {
        const chatMessages = document.getElementById('chatMessages');
        const windowHeight = window.innerHeight;

        // Ha az eszköz szélessége kisebb mint 768px, mobil eszközként kezeljük
        if (window.innerWidth < 768) {
            chatMessages.style.height = (windowHeight * 0.65) + 'px'; // 60% mobilon
        } else {
            chatMessages.style.height = (windowHeight * 0.8) + 'px'; // 80% asztali gépen
        }
    }

    // Az oldal betöltésekor és ablak átméretezésekor meghívja a függvényt
    window.addEventListener('load', adjustChatHeight);
    window.addEventListener('resize', adjustChatHeight);


 const roomID = {{$room->id}};
const roomName = '{{$room->name}}';
document.getElementById('roomName').innerText = roomName;



document.getElementById('msgSendBtn').addEventListener('click', function() {
    // Az értékek beolvasása az űrlap mezőkből vagy más forrásokból
   
    const message = document.getElementById('sendmessage').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Kérés küldése a szerverre
    fetch('{{route('setRoomMessage')}}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        // Az üzenet küldése paraméterekben
        body: JSON.stringify({
            room_id: roomID,
            msg: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alert("Üzenet sikeresen elküldve!");
        } else {
            alert("Hiba történt: " + data.error);
        }
    })
    .catch(error => {
        console.error("Hálózati hiba:", error);
    });
});


//const roomId = 1; // A szoba ID-t állítsd be dinamikusan szükség szerint

setInterval(() => {
    fetch('{{ route('getRoomUsers.post') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ room_id: roomID })
    })
    .then(response => response.json())
    .then(users => {
        const userList = document.querySelector('.user-list');

        // Jelenlegi felhasználók ID-jainak összegyűjtése a DOM-ból
        const currentUserIds = Array.from(document.querySelectorAll('.user'))
            .map(userDiv => parseInt(userDiv.id.replace('user-', '')));

        // Szerverről érkező új felhasználók ID-inak gyűjteménye
        const newUserIds = users.map(user => user.id);

        // 1. Töröljük a DOM-ból azokat a felhasználókat, akik már nincsenek a szerver válaszában
        currentUserIds.forEach(id => {
            if (!newUserIds.includes(id)) {
                const userToRemove = document.getElementById(`user-${id}`);
                if (userToRemove) {
                    userToRemove.remove();
                }
            }
        });

        // 2. Hozzáadjuk az új felhasználókat, akik még nem szerepelnek a DOM-ban
        users.forEach(user => {
            if (!document.getElementById(`user-${user.id}`)) {
                const userDiv = document.createElement('div');
                userDiv.id = `user-${user.id}`;
                userDiv.classList.add('user');
                let opPic = ``;
                if(user.op_room_id == roomID) 
                {
                    opPic = `<span><img src="{{asset('images/roomicons/szobaop.png')}}" class="min32px" title="Szoba operátor"></span`;
                }

                if(user.p_id == 1) 
                {
                    opPic = opPic +`<span><img src="{{asset('images/roomicons/admin.png')}}" class="min32px" title="Adminisztrátor"></span`;
                }

                userDiv.innerHTML = `
                     <img src="/images/${user.profilepicture}" alt="User avatar" class="user-avatar">
                    <div class="user-details">
                        <span class="user-name">${user.username}</span>
                        <div class="user-icons">
                            <!-- Dinamikus linkek létrehozása -->
                            <a href="/user/generalinfo/${user.id}" target="_blank">
                                <i class="fa fa-address-book"></i>
                            </a>
                            <i class="fa-solid fa-phone"></i>
                            <i class="fas fa-video-camera"></i>
                            <a href="/chat/privateRoom/${user.id}" target="_blank">
                                <i class="fas fa-comment"></i>
                            </a>
                            `+ opPic +`
                        </div>
                    </div>
                `;

                // Hozzáadjuk a `user-list` konténerhez
                userList.appendChild(userDiv);
            }
        });
    })
    .catch(error => console.error('Error:', error));
}, 1700);

</script>




@endsection

