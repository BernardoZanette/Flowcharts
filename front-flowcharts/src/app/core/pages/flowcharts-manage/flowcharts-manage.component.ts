import { Component, ElementRef, ViewChild, Renderer2 } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-flowcharts-manage',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule
  ],
  templateUrl: './flowcharts-manage.component.html',
  styleUrl: './flowcharts-manage.component.css'
})
export class FlowchartsManageComponent {

  constructor(
    private flowchartService: FlowchartService,
    private el: ElementRef, 
    private renderer: Renderer2 
  ) {};

  @ViewChild('modal', { static: true }) modal: ElementRef;
  @ViewChild('flowchartTitle', { static: true }) flowchartTitleDiv: ElementRef;
  @ViewChild('tableBody', { static: true }) tableBody: ElementRef;

  flowcharts!: FlowchartResponse[];
  editingFlowchart: boolean = false;
  flowchartTitle!: string;
  flowchartId!: number;
  editSign: string = "assets/images/edit-sign.png";
  trash: string = "assets/images/trash.png";

  async ngOnInit() {
    
    await this.getFlowcharts();
    await this.setTableStructure(this.flowcharts);
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
    await this.callModal();
  }

  async editFlowchart(flowchartTitle: any) {

    let flowchartData = {
      "title": flowchartTitle.value, 
    }

    await this.flowchartService.editFlowchart(flowchartData, this.flowchartId);
    this.modal.nativeElement.setAttribute("class", "modalOff");
    flowchartTitle.value = "";
    await this.getFlowcharts();
    await this.setTableStructure(this.flowcharts);
    this.modal.nativeElement.setAttribute("class", "modalOff");
    this.editingFlowchart = false;
  }

  async removeFlowchart(flowchartId: number) {

    await this.flowchartService.removeFlowchart(flowchartId);
    await this.getFlowcharts();
    await this.setTableStructure(this.flowcharts);
  }

  async addFlowchart(flowchartTitle: any) {
    
    let flowchartData = {
      "title": flowchartTitle.value
    };
    await this.flowchartService.createFlowchart(flowchartData);
    this.modal.nativeElement.setAttribute("class", "modalOff");
    flowchartTitle.value = "";
    await this.getFlowcharts();
    await this.setTableStructure(this.flowcharts);
  }

  public callModal() {

    this.modal.nativeElement.setAttribute("class", "modalOn");
  }
  
  public backToScreen(flowchartTitle: any) {
    
    this.editingFlowchart = false;
    flowchartTitle.value = "";
    this.modal.nativeElement.setAttribute("class", "modalOff");
  }

  async setTableStructure(flowcharts) {

    this.renderer.setProperty(this.tableBody.nativeElement, 'innerHTML', "");

    flowcharts.forEach((flowchart: any, index :number) => {

      const tr = this.renderer.createElement('tr');

      const tdIdElement = this.renderer.createElement('td');
      const tdId = this.renderer.createText(`${index+1}`);
      const tdTitleElement = this.renderer.createElement('td');
      const tdTitle = this.renderer.createText(`${flowchart.title}`);
      const tdCreatedAtElement = this.renderer.createElement('td');
      const tdCreatedAt = this.renderer.createText(`${flowchart.created_at}`);
      const tdUpdatedAtElement = this.renderer.createElement('td');
      const tdUpdatedAt = this.renderer.createText(`${flowchart.updated_at}`);

      const tdActions = this.renderer.createElement('td');

      const editButton = this.renderer.createElement('button');
      this.renderer.addClass(editButton, 'editButton');
      editButton.addEventListener('click', this.callEditModal.bind(this, flowchart.id, flowchart.title));

      const imgEditSign = this.renderer.createElement('img');
      this.renderer.addClass(imgEditSign, 'icons');
      this.renderer.setAttribute(imgEditSign, 'src', this.editSign);
      this.renderer.setAttribute(imgEditSign, 'alt', 'edit sign');

      const removeButton = this.renderer.createElement('button');
      this.renderer.addClass(removeButton, 'removeButton');
      removeButton.addEventListener('click', this.removeFlowchart.bind(this, flowchart.id));

      const imgTrash = this.renderer.createElement('img');
      this.renderer.addClass(imgTrash, 'icons');
      this.renderer.setAttribute(imgTrash, 'src', this.trash);
      this.renderer.setAttribute(imgTrash, 'alt', 'remove sign');

      this.renderer.appendChild(editButton, imgEditSign);
      this.renderer.appendChild(removeButton, imgTrash);
      this.renderer.appendChild(tdActions, editButton);
      this.renderer.appendChild(tdActions, removeButton);

      this.renderer.appendChild(tr, tdIdElement);
      this.renderer.appendChild(tdIdElement, tdId);
      this.renderer.appendChild(tr, tdTitleElement);
      this.renderer.appendChild(tdTitleElement, tdTitle);
      this.renderer.appendChild(tr, tdCreatedAtElement);
      this.renderer.appendChild(tdCreatedAtElement, tdCreatedAt);
      this.renderer.appendChild(tr, tdUpdatedAtElement);
      this.renderer.appendChild(tdUpdatedAtElement, tdUpdatedAt);
      this.renderer.appendChild(tr, tdActions);
      this.renderer.appendChild(this.tableBody.nativeElement, tr);
    });
  }
}

