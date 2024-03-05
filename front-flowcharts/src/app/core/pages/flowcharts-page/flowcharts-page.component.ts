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

  // @ViewChild('flowchart', { static: true }) flowchartDiv: ElementRef;

  pais!: [];
  flowchartStructure!: FlowchartResponse[];
  flowcharts!: FlowchartResponse[];
  flowchartId!: number;
  actualParentId!:number;

  ngOnInit() {
    this.getFlowcharts()
    this.flowchartId = 1
    this.getFlowchartStructure() 
    // console.log(this.flowchartDiv.nativeElement);
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
      console.log(step)

      // IS SON
      if (stepParentValues.length !== 0) {
        this.actualParentId = stepParentValues[0]['step_parent_id']
        console.log('filho: ' + step.id + ' com o pai: ' + this.actualParentId)
        
        // const conjunto_pai = document.getElementById(this.actualParentId.toString()).parentNode

        // const div_filho = document.getElementById(step.id.toString())

        // this.renderer.appendChild(conjunto_pai, div_filhos)
        // this.renderer.appendChild(div_filhos, div_filho)
        
      }
      // IS FATHER:
      else {
        console.log('pai: ' + step.id)
        
        // const pai = document.getElementById(step.id.toString());
        
        // const conjunto = this.renderer.createElement('div');
        // conjunto.setAttribute('class', 'conjuntoPaiFilho')

        // this.renderer.appendChild((pai.parentNode), conjunto)
        // this.renderer.appendChild(conjunto, pai)

        // var div_filhos = this.renderer.createElement('div');
        // div_filhos.setAttribute('class', 'filhos')

      }
    })
  }

}
