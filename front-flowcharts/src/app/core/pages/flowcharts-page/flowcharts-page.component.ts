import { Component } from '@angular/core';
import { FlowchartResponse, FlowchartService } from '../../../services/flowchart.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-flowcharts-page',
  standalone: true,
  imports: [
    CommonModule
  ],
  templateUrl: './flowcharts-page.component.html',
  styleUrl: './flowcharts-page.component.css'
})
export class FlowchartsPageComponent {
  constructor(private flowchartService: FlowchartService) {}

  flowchart!: FlowchartResponse[];

  ngOnInit() {
    this.getSketchesList();
  }

  getSketchesList() {
    this.flowchartService.getStructure(2).subscribe((flowchartData:any) => {
      this.flowchart = flowchartData
      console.log(this.flowchart)
    })
  }

}
