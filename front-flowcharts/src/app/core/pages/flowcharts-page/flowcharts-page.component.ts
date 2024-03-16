import { Component, ElementRef, ViewChild } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Renderer2 } from '@angular/core';
import { StepResponse, StepService } from '../../../services/step.service';
import { ParentResponse, ParentsService } from '../../../services/parents.service';

@Component({
  selector: 'app-flowcharts-page',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule 
  ],
  templateUrl: './flowcharts-page.component.html',
  styleUrl: './flowcharts-page.component.css'
})
export class FlowchartsPageComponent {

  constructor(
    private flowchartService: FlowchartService, 
    private stepService: StepService,
    private parentsService: ParentsService,
    private renderer: Renderer2
  ) {}

  @ViewChild('flowchart', { static: true }) flowchartDiv: ElementRef;

  flowcharts!: FlowchartResponse[];
  flowchartId!: number;
  actualParentId!:number;
  connections!: ParentResponse[];
  steps!: StepResponse[];
  overStepsHtml: any = [];

  async ngOnInit() {
    await this.getFlowcharts();
    await this.setFlowchartStructure();
  }

  async getFlowcharts() {
    let flowcharts = await this.flowchartService.getFlowcharts();
    this.flowcharts = flowcharts
    this.flowchartId = flowcharts[0].id
  }

  async setFlowchartStructure() {

    await this.parentsService.getParentsByFlowchartId(this.flowchartId).then(connections => {
      this.connections = connections;
    });
    this.stepService.getStepsByFlowchartId(this.flowchartId).then(steps => {
      this.steps = steps
      this.drawFlowchartStructure();
    });

  }


  private drawFlowchartStructure() {

    // Limpar flowchart e botar o novo:
    this.renderer.setProperty(this.flowchartDiv.nativeElement, 'innerHTML', "");
    this.overStepsHtml = []

    const stepsQueue = [];
    if (this.steps) stepsQueue.push(this.getRootStep());
    this.drawStep(stepsQueue[0]);

    while(stepsQueue.length > 0) {
      let currentStep = stepsQueue.shift();
      let currentChildren = this.getChildrenFrom(currentStep);
      if (currentChildren) stepsQueue.push(...currentChildren);
      this.drawChildrenSteps(currentStep, currentChildren);
    }

  }

  private getRootStep(){
    const childrenStepIds = [];
    this.connections.forEach(connection => {
      childrenStepIds.push(connection.step_id);
    })
    return this.steps.find(step => !childrenStepIds.includes(step.id));
  }

  private getChildrenFrom(step) {
    const childrenStepIds = [];
    this.connections.forEach(connection => {
      if (step.id == connection.step_parent_id) {
        childrenStepIds.push(connection.step_id);
      }
    })

    return this.steps.filter(step => childrenStepIds.includes(step.id));
  }

  private drawStep(step) {
      if (!step) return;
      const overStepDiv = this.renderer.createElement('div');
      const stepDiv = this.renderer.createElement('div');
      const spanStep = this.renderer.createElement('span');
      const textStep = this.renderer.createText(step.title);

      this.renderer.setAttribute(overStepDiv, 'id', step.id.toString());
      this.renderer.setAttribute(stepDiv, 'class', 'steps');
      this.renderer.setAttribute(overStepDiv, 'class', 'overSteps');

      this.renderer.appendChild(spanStep, textStep);
      this.renderer.appendChild(stepDiv, spanStep);
      this.renderer.appendChild(overStepDiv, stepDiv);
      this.renderer.appendChild(this.flowchartDiv.nativeElement, overStepDiv);

      this.overStepsHtml.push(overStepDiv);
      return overStepDiv;
  }

  private drawChildrenSteps(parent, children) {
      const groupDiv = this.renderer.createElement('div');

      this.renderer.setAttribute(groupDiv, 'class', 'groupChildren');

      const parentHtml = this.overStepsHtml.find(step => step.id == parent.id);

      children.forEach(child => {
        let childHtml = this.drawStep(child);
        if (childHtml && parentHtml) this.renderer.appendChild(groupDiv, childHtml);
      });

      if (parentHtml) this.renderer.appendChild(parentHtml, groupDiv);

  }

}
