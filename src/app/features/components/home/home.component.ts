import { Component } from '@angular/core';
import { MatCardModule } from '@angular/material/card';
import { LoginComponent } from '../../../shared/components/login/login.component';

@Component({
  selector: 'app-home',
  imports: [
    LoginComponent,
    MatCardModule,
  ],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {
  
}
