import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface FlowchartResponse {
  "id": number
  "title": string
  "flowchartId": number
  "stepParentsIds": [
    {
      "id": number
      "step_id": number
      "step_parent_id": number
      // "deleted_at": 
      // "created_at": 
      // "updated_at": 
    }
  ]
}

@Injectable({
  providedIn: 'root'
})

export class FlowchartService {

  public base: string = mainEnvironment.SERVER_URL + "flowcharts";

  constructor(private httpClient: HttpClient) {}

  getStructure(flowchartId : number) {
    return this.httpClient.get(`${this.base}/${flowchartId}/structure`);
  }

}
