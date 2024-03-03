import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface FlowchartResponse {
  "id": number
  "title": string
  "flowchartId": number
  "stepParentIds": []
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

  getFlowcharts() {
    return this.httpClient.get(`${this.base}`);
  }

}
