import { Routes } from '@angular/router';
import { HomeComponent } from './features/components/home/home.component';
import { AdminComponent } from './features/components/admin/admin.component';

export const routes: Routes = [
    {path: '', component: HomeComponent, title: 'Home Page'},
    {path: 'admin', component: AdminComponent, title: 'Admin Page'},
];
