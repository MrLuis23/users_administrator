import { Component, inject } from '@angular/core';
import { MatInputModule } from '@angular/material/input';
import { MatButtonModule } from '@angular/material/button';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { AuthService } from '../../../core/services/auth/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  imports: [
    MatInputModule,
    MatButtonModule,
    ReactiveFormsModule,
  ],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})

export class LoginComponent {
  private fb          = inject(FormBuilder);
  private authService = inject(AuthService);
  private router      = inject(Router);

  protected loginForm = this.fb.group({
    username: ['', Validators.required],
    password: ['', Validators.required],
  });

  ngOnInit(): void{
    
  }

  onSubmit(){
    console.log('form', this.loginForm.getRawValue());

    const authenticated = this.authService.login({
      username: this.loginForm.get('username')?.getRawValue(),
      password: this.loginForm.get('password')?.getRawValue(),
    });

    if(authenticated) this.router.navigate(['admin']);
    else this.router.navigate(['home']);
    console.log(authenticated);
  }

}
