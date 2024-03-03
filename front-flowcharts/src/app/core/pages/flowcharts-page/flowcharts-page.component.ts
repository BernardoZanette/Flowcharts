import { Component, ViewChild } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

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

  constructor(private flowchartService: FlowchartService) {}

  pais!: [];
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
    let structure = this.flowchartStructure
    structure.forEach((step) => { 
      const stepParentValues = Object.values(step.stepParentIds)
      console.log(stepParentValues)
      if (stepParentValues.length !== 0) {
        this.actualParentId = stepParentValues[0]['step_parent_id']
      }
      else {
        console.log('pai: '+ step.id)
      }
    })
  }

}
