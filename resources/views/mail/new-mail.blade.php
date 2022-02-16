<div>
   <h2>Hai ricevuto una nuova email</h2>

   <div>
      <h6>
         Da: {{ $new_contact->name }}
      </h6>
      <h5>
         Email: {{ $new_contact->email }}
      </h5>
      <p>Contenuto: {{ $new_contact->msg }}</p>
   </div>
</div>