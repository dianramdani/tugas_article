<div>
    <h1>Hai {{$email}}</h1>
        <h3>Someone has request for reset password, if don't disobey this email.</h3>
        <p>
            To reset your password please follow this link : {{link_to('change-password/'.$remember_token, 'Change Password')}}
        </p>
</div>