import { Component, ElementRef, ViewChild } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Renderer2 } from '@angular/core';

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

  constructor(private flowchartService: FlowchartService, private renderer: Renderer2) {}

  @ViewChild('flowchart', { static: true }) flowchartDiv: ElementRef;

  flowchartStructure!: FlowchartResponse[];
  flowcharts!: FlowchartResponse[];
  flowchartId!: number;
  actualParentId!:number;

  ngOnInit() {
    this.getFlowcharts()
    this.flowchartId = 1
    this.getFlowchartStructure() 
  }

  // TO-DO: trocar data-type depois de subscribe
  getFlowcharts() {
    this.flowchartService.getFlowcharts().subscribe((flowcharts:any) => {
      this.flowcharts = flowcharts
    })
  }

  getFlowchartStructure() {
    this.flowchartService.getStructure(this.flowchartId).subscribe((flowchartData: any) => {
      this.flowchartStructure = flowchartData
      this.structureChildren()
    })
  } 

  structureChildren() {
    
    // Limpar flowchart e botar o novo:
    this.renderer.setProperty(this.flowchartDiv.nativeElement, 'innerHTML', "")
    
    let structure = this.flowchartStructure
    console.log(structure)
    const parents = []

    // console.log(structure)
    structure.forEach((step) => {

      const stepParentValues = Object.values(step.stepParentIds)
      // console.log(step)
      // console.log(stepParentValues)

      const stepDiv = this.renderer.createElement('div');
      const spanStep = this.renderer.createElement('span');
      const textStep = this.renderer.createText(step.title)
      this.renderer.setAttribute(stepDiv, 'id', step.id.toString())
      this.renderer.setAttribute(stepDiv, 'class', 'steps')
      this.renderer.appendChild(spanStep, textStep);
      this.renderer.appendChild(stepDiv, spanStep);

      this.renderer.appendChild(this.flowchartDiv.nativeElement, stepDiv)

      // console.log(stepParentValues)
      // IS SON
      if (stepParentValues.length !== 0) {
        // const parent = parents.filter((parent) => parent.id == stepParentValues[0]['step_parent_id']);
        // this.renderer.appendChild(this.flowchartDiv.nativeElement, stepDiv)
      }

      // // IS FATHER:
      else {
        
        // parents.push(stepDiv)
        // this.renderer.appendChild(this.flowchartDiv.nativeElement, stepDiv)

      }
      })
  }

}
