import { Component, ElementRef, ViewChild, Pipe } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { SearchPipe } from './search.pipe';

@Component({
  selector: 'app-flowcharts-manage',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule,
    SearchPipe
  ],
  templateUrl: './flowcharts-manage.component.html',
  styleUrl: './flowcharts-manage.component.css'
})

export class FlowchartsManageComponent {

  constructor(
    private flowchartService: FlowchartService,
) {};

  @ViewChild('modal', { static: true }) modal: ElementRef;
  @ViewChild('flowchartTitle', { static: true }) flowchartTitleDiv: ElementRef;

  searchText: string = '';
  flowcharts!: FlowchartResponse[];
  editingFlowchart: boolean = false;
  flowchartTitle!: string;
  flowchartId!: number;

  async ngOnInit() {
    
    await this.getFlowcharts();
  }

  async getFlowcharts() {
    
    let flowcharts = await this.flowchartService.getFlowcharts();
    this.flowcharts = flowcharts;
  }
  
  async callEditModal(flowchartId: number, flowchartTitle: any) {

    this.flowchartTitle = flowchartTitle;
    this.flowchartTitleDiv.nativeElement.value = this.flowchartTitle;
    this.flowchartId = flowchartId;
    this.editingFlowchart = true;
    this.callModal();
  }

  async editFlowchart(flowchartTitle: any) {

    let flowchartData = {
      "title": flowchartTitle.value, 
    }

    await this.flowchartService.editFlowchart(flowchartData, this.flowchartId);
    this.modal.nativeElement.setAttribute("class", "modalOff");
    flowchartTitle.value = "";
    await this.getFlowcharts();
    this.modal.nativeElement.setAttribute("class", "modalOff");
    this.editingFlowchart = false;
  }

  async removeFlowchart(flowchartId: number) {

    await this.flowchartService.removeFlowchart(flowchartId);
    await this.getFlowcharts();
  }

  async addFlowchart(flowchartTitle: any) {
    
    let flowchartData = {
      "title": flowchartTitle.value
    };
    await this.flowchartService.createFlowchart(flowchartData);
    this.modal.nativeElement.setAttribute("class", "modalOff");
    flowchartTitle.value = "";
    await this.getFlowcharts();
  }

  public callModal() {

    this.modal.nativeElement.setAttribute("class", "modalOn");
  }
  
  public backToScreen(flowchartTitle: any) {
    
    this.editingFlowchart = false;
    flowchartTitle.value = "";
    this.modal.nativeElement.setAttribute("class", "modalOff");
  }
}

