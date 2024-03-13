import { Injectable } from '@angular/core';
import { mainEnvironment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

export interface StepResponse {
  "id": number
  "title": string
  "flowchartId": number
}

@Injectable({
  providedIn: 'root'
})
export class StepService {

  public base: string = mainEnvironment.SERVER_URL + "steps";

  constructor(private httpClient: HttpClient) {}

  getStepsByFlowchartId(flowchartId: number) {
    return this.httpClient.get(`${this.base}/flowchart/${flowchartId}`);
  }

}
