import { Routes } from '@angular/router';
import { FlowchartsPageComponent } from './core/pages/flowcharts-page/flowcharts-page.component';
import { FlowchartsManageComponent } from './core/pages/flowcharts-manage/flowcharts-manage.component';

export const routes: Routes = [
    {path: '', component: FlowchartsManageComponent, title:'Flowcharts Management'},
    {path: 'list', component: FlowchartsPageComponent, title:'Flowcharts list'},
];
